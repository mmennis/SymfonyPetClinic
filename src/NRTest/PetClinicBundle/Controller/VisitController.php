<?php

namespace NRTest\PetClinicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NRTest\PetClinicBundle\Entity\Visit;
use NRTest\PetClinicBundle\Form\VisitType;

/**
 * Visit controller.
 *
 */
class VisitController extends Controller
{
    /**
     * Lists all Visit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NRTestPetClinicBundle:Visit')->findAll();

        return $this->render('NRTestPetClinicBundle:Visit:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Visit entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Visit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Visit:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Visit entity.
     *
     */
    public function newAction()
    {
        $entity = new Visit();
        $form   = $this->createForm(new VisitType(), $entity);

        return $this->render('NRTestPetClinicBundle:Visit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Visit entity.
     *
     */
    public function createAction()
    {
        $entity  = new Visit();
        $request = $this->getRequest();
        $form    = $this->createForm(new VisitType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visit_show', array('id' => $entity->getId())));
            
        }

        return $this->render('NRTestPetClinicBundle:Visit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Visit entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Visit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visit entity.');
        }

        $editForm = $this->createForm(new VisitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Visit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Visit entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Visit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visit entity.');
        }

        $editForm   = $this->createForm(new VisitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visit_edit', array('id' => $id)));
        }

        return $this->render('NRTestPetClinicBundle:Visit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Visit entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('NRTestPetClinicBundle:Visit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Visit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('visit'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
