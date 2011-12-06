<?php

namespace NRTest\PetClinicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NRTest\PetClinicBundle\Entity\Specialty;
use NRTest\PetClinicBundle\Form\SpecialtyType;

/**
 * Specialty controller.
 *
 */
class SpecialtyController extends Controller
{
    /**
     * Lists all Specialty entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NRTestPetClinicBundle:Specialty')->findAll();

        return $this->render('NRTestPetClinicBundle:Specialty:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Specialty entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Specialty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Specialty entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Specialty:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Specialty entity.
     *
     */
    public function newAction()
    {
        $entity = new Specialty();
        $form   = $this->createForm(new SpecialtyType(), $entity);

        return $this->render('NRTestPetClinicBundle:Specialty:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Specialty entity.
     *
     */
    public function createAction()
    {
        $entity  = new Specialty();
        $request = $this->getRequest();
        $form    = $this->createForm(new SpecialtyType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('specialty_show', array('id' => $entity->getId())));
            
        }

        return $this->render('NRTestPetClinicBundle:Specialty:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Specialty entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Specialty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Specialty entity.');
        }

        $editForm = $this->createForm(new SpecialtyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Specialty:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Specialty entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Specialty')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Specialty entity.');
        }

        $editForm   = $this->createForm(new SpecialtyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('specialty_edit', array('id' => $id)));
        }

        return $this->render('NRTestPetClinicBundle:Specialty:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Specialty entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('NRTestPetClinicBundle:Specialty')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Specialty entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('specialty'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
